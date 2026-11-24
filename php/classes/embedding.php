<?php

class embedding {
    
    
    function getEmbedding(string $text): array
    {
        $ch = curl_init($GLOBALS["conf"]["url_embedding"]);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode(['text' => $text]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
        ]);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status !== 200) {
            throw new RuntimeException("Service embeddings indisponible ($status)");
        }
        return json_decode($response, true)['embedding'];
    }
    
    
} // fin de la classe



?>

