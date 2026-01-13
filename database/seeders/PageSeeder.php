<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'name' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'content' => <<<'MD'
![Terms Illustration](https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=1200&q=80)

## General Terms
- All prices include applicable taxes unless stated otherwise.
- Digital purchases (e-books/courses) are final and non-refundable once accessed or downloaded.
- Physical shipments follow the carrier and service level chosen at checkout.

## Orders & Shipping
1. Orders are processed after payment is verified.
2. Delivery timelines follow the selected courier service.
3. For delays, contact support and include your order number.

## Cancellations & Refunds
- Digital products: non-refundable after access.
- Physical products: refunds may be requested within 3 days of receipt for damaged or defective items.

## Copyright
Digital content is for personal use only. Reproduction or distribution without written permission is prohibited.
MD,
            ],
            [
                'name' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => <<<'MD'
![Privacy Illustration](https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80)

## Data We Collect
- Name, email, and phone number for transactions and notifications.
- Address details for shipping physical items.
- Site activity (pages viewed, searches) to improve our services.

## How We Use Your Data
- Process orders and deliveries.
- Send order status updates and limited promotions.
- Detect and prevent fraud or abuse.

## Security
We apply encryption to sensitive data and restrict access internally to authorized team members only.

## Your Rights
You may request account deletion or data updates by contacting our support team.
MD,
            ],
            [
                'name' => 'Customers',
                'slug' => 'customers',
                'content' => <<<'MD'
![Customers Illustration](https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80)

## Customer Support
Need help? Our team is available on business days from 09:00–18:00 WIB.

### Primary Contacts
- Email: support@webstore.test
- WhatsApp: +62 812-0000-0000

### Popular Help Topics
1. Order status and tracking numbers
2. Payment or verification issues
3. Access to digital products (download links / class login)

### How to Claim Warranty for Physical Items
1. Take photos of the product and outer packaging.
2. Include your order number and a brief description of the issue.
3. Send them to the contacts above; our team will respond within 1 business day.
MD,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                ['name' => $page['name'], 'content' => $page['content']]
            );
        }
    }
}
