#!/usr/bin/env bash
# Usage: payload='{"id":1}' SECRET=la_tua_chiave_segreta ./scripts/generate-signature.sh
payload=${payload:-'{"id":123,"status":"created"}'}
SECRET=${SECRET:-'la_tua_chiave_segreta'}
sig=$(echo -n "$payload" | openssl dgst -sha256 -hmac "$SECRET" -binary | base64)
echo "Payload: $payload"
echo "Signature: $sig"
echo "Curl example:"
echo "curl -H \"Content-Type: application/json\" -H \"X-WC-Webhook-Signature: $sig\" -d '$payload' https://<tuo-sito>.netlify.app/.netlify/functions/klaviyo-webhook"
