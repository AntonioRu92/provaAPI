const crypto = require('crypto');

exports.handler = async (event) => {
  const secret = process.env.WC_WEBHOOK_SECRET;
  if (!secret) return { statusCode: 500, body: 'Secret not set' };

  const body = event.body || '';
  const received = event.headers['x-wc-webhook-signature'] || event.headers['X-WC-Webhook-Signature'] || '';
  const expected = crypto.createHmac('sha256', secret).update(body, 'utf8').digest('base64');

  try {
    const valid = crypto.timingSafeEqual(Buffer.from(expected), Buffer.from(received));
    if (!valid) return { statusCode: 401, body: 'Invalid signature' };
  } catch (e) {
    return { statusCode: 401, body: 'Invalid signature comparison' };
  }

  // Handle the payload (log for now)
  let payload = {};
  try { payload = JSON.parse(body || '{}'); } catch (e) { payload = { raw: body }; }
  console.log('klaviyo-webhook payload:', payload);

  // TODO: forward to Klaviyo or process accordingly
  return {
    statusCode: 200,
    body: JSON.stringify({ ok: true })
  };
};
