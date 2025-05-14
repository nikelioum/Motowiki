<div style="font-family: Arial, sans-serif; padding: 20px;">
    <h1 style="color: #111; font-size: 24px;">Thanks for subscribing to our newsletter!</h1>
    <p style="color: #555; font-size: 16px;">
        We’re glad to have you on board. You’ll be the first to know about our latest news and updates.
    </p>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}"
           style="display: inline-block; background-color: #000; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-size: 16px;">
            Unsubscribe
        </a>
    </div>
</div>
