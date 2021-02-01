<?php

namespace Spatie\LaravelRay\Tests\Unit;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\LaravelRay\Tests\Concerns\MatchesOsSafeSnapshots;
use Spatie\LaravelRay\Tests\TestCase;
use Spatie\LaravelRay\Tests\TestClasses\TestMailable;

class MailableTest extends TestCase
{
    use MatchesOsSafeSnapshots;

    /** @test */
    public function it_can_send_the_mailable_payload()
    {
        ray()->mailable(new TestMailable());

        $this->assertCount(1, $this->client->sentPayloads());
    }

    /** @test */
    public function it_can_send_a_logged_mailable()
    {
        Mail::mailer('log')
            ->cc(['adriaan' => 'adriaan@spatie.be', 'seb@spatie.be'])
            ->bcc(['willem@spatie.be', 'jef@spatie.be'])
            ->to(['freek@spatie.be', 'ruben@spatie.be'])
            ->send(new TestMailable());

        $this->assertCount(1, $this->client->sentPayloads());
    }
}
