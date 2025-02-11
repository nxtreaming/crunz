<?php

declare(strict_types=1);

namespace Crunz\Process;

use Symfony\Component\Process\Process as SymfonyProcess;

/** @internal */
final class Process
{
    /** @param SymfonyProcess|string[] $process */
    private function __construct(private readonly SymfonyProcess $process)
    {
    }

    public static function fromStringCommand(string $command, ?string $cwd = null): self
    {
        $process = SymfonyProcess::fromShellCommandline($command, $cwd);

        return new self($process);
    }

    /** @param string[] $command */
    public static function fromArrayCommand(array $command): self
    {
        $process = new SymfonyProcess($command);

        return new self($process);
    }

    /** @param callable|null $callback */
    public function start($callback = null): void
    {
        $this->process
            ->start($callback);
    }

    public function wait(): void
    {
        $this->process
            ->wait();
    }

    public function startAndWait(): void
    {
        $this->process
            ->start();
        $this->process
            ->wait();
    }

    /** @param array<string,string> $env */
    public function setEnv(array $env): void
    {
        $this->process
            ->setEnv($env);
    }

    public function getPid(): ?int
    {
        return $this->process
            ->getPid();
    }

    public function isRunning(): bool
    {
        return $this->process
            ->isRunning();
    }

    public function isSuccessful(): bool
    {
        return $this->process
            ->isSuccessful();
    }

    public function getOutput(): string
    {
        return $this->process
            ->getOutput();
    }

    public function errorOutput(): string
    {
        return $this->process
            ->getErrorOutput();
    }

    public function commandLine(): string
    {
        return $this->process
            ->getCommandLine()
        ;
    }
}
