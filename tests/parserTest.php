<?php declare(strict_types=1);

use App\Parser;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    public function testCanBeCreatedNewClass(): void
    {
        $this->assertInstanceOf(
            Parser::class,
            new Parser
        );
    }

    public function testUserFileExists(): void
    {
        $this->assertFileExists('./storage/user-channel.txt');
    }

    public function testCustomerFileExists(): void
    {
        $this->assertFileExists('./storage/customer-channel.txt');
    }

    public function testParseUserFile(): void
    {
        $parser = New Parser;
        $parser->processInput('user-channel.txt');

        $this->assertEquals(
            $parser->get('max_monolog'),
            322.35
        );
    }

    public function testParseCustomerFile(): void
    {
        $parser = New Parser;
        $parser->processInput('customer-channel.txt');

        $this->assertEquals(
            $parser->get('max_monolog'),
            177.96799999999996
        );
    }

    public function testUserTalkPercentage(): void
    {
        $parser = New Parser;
        $parser->processInput('user-channel.txt');
        $duration = $parser->get('totalDuration');
        $maxMonolog = $parser->get('max_monolog');

        $this->assertEquals(
            ($maxMonolog / $duration) * 100,
            17.36079320540509
        );
    }

}