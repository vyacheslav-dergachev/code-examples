<?php

namespace DDTrace;

if (!\function_exists('DDTrace\current_context')) {
    /**
     * @return array<string, string>
     */
    function current_context(): array
    {
        return [
            'trace_id' => 'expected-trace-id',
            'span_id' => 'expected-span-id',
        ];
    }
}
