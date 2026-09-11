<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use RuntimeException;

final class StatusChecker
{
    public static function validate(Step $step, int $actualStatus): void
    {
        if ($actualStatus === 0) {
            // Only accept status 0 when no expectation is configured.
            if ($step->allowedStatuses !== [] || $step->expectedStatus !== 0) {
                throw new RuntimeException(sprintf(
                    "Unexpected status code for step '%s' (%s): status expectation configured but actual status is 0",
                    $step->name,
                    $step->clientMethod
                ));
            }
            return;
        }
        if ($step->allowedStatuses !== []) {
            if (!in_array($actualStatus, $step->allowedStatuses, true)) {
                throw new RuntimeException(sprintf(
                    "Unexpected status code for step '%s' (%s): expected one of [%s], got %d",
                    $step->name,
                    $step->clientMethod,
                    implode(', ', $step->allowedStatuses),
                    $actualStatus
                ));
            }
            return;
        }
        if ($step->expectedStatus !== 0 && $step->expectedStatus !== $actualStatus) {
            throw new RuntimeException(sprintf(
                "Unexpected status code for step '%s' (%s): expected %d, got %d",
                $step->name,
                $step->clientMethod,
                $step->expectedStatus,
                $actualStatus
            ));
        }
    }
}
