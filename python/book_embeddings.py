"""Service d'embeddings pour les livres.
Démarrage : uvicorn book_embeddings:app --host 0.0.0.0 --port 8000
"""

import logging
from contextlib import asynccontextmanager

from fastapi import FastAPI, HTTPException
from pydantic import BaseModel, Field
from sentence_transformers import SentenceTransformer

# -- Configuration ----------------------------------------------------------

MODEL_NAME = "paraphrase-multilingual-MiniLM-L12-v2"  # multilingue, léger (~470 Mo)
LOG_LEVEL = logging.INFO

logging.basicConfig(level=LOG_LEVEL, format="%(asctime)s %(levelname)s %(message)s")
logger = logging.getLogger("book_embeddings")

# -- Modèles Pydantic -------------------------------------------------------


class EmbedRequest(BaseModel):
    text: str = Field(..., min_length=1, description="Texte à vectoriser")


class EmbedBatchRequest(BaseModel):
    texts: list[str] = Field(..., min_length=1, description="Liste de textes")


class EmbedResponse(BaseModel):
    embedding: list[float]
    dim: int


class EmbedBatchResponse(BaseModel):
    embeddings: list[list[float]]
    dim: int


# -- Chargement du modèle (une seule fois, au démarrage) --------------------

model: SentenceTransformer | None = None


@asynccontextmanager
async def lifespan(app: FastAPI):
    global model
    logger.info("Chargement du modèle %s...", MODEL_NAME)
    model = SentenceTransformer(MODEL_NAME)
    logger.info("Modèle chargé (dim=%d)", model.get_sentence_embedding_dimension())
    yield
    logger.info("Arrêt du service")


app = FastAPI(title="Book Embeddings Service", lifespan=lifespan)


# -- Routes -----------------------------------------------------------------


@app.get("/health")
def health() -> dict:
    """Healthcheck : prêt seulement quand le modèle est chargé."""
    if model is None:
        raise HTTPException(status_code=503, detail="modèle non chargé")
    return {"status": "ok", "model": MODEL_NAME}


@app.post("/embed", response_model=EmbedResponse)
def embed(req: EmbedRequest) -> EmbedResponse:
    if model is None:
        raise HTTPException(status_code=503, detail="modèle non chargé")
    vector = model.encode(req.text, normalize_embeddings=True)
    return EmbedResponse(embedding=vector.tolist(), dim=len(vector))


@app.post("/embed_batch", response_model=EmbedBatchResponse)
def embed_batch(req: EmbedBatchRequest) -> EmbedBatchResponse:
    """Vectorise plusieurs textes en une requête (plus rapide)."""
    if model is None:
        raise HTTPException(status_code=503, detail="modèle non chargé")
    vectors = model.encode(req.texts, normalize_embeddings=True)
    return EmbedBatchResponse(
        embeddings=vectors.tolist(), dim=vectors.shape[1]
    )