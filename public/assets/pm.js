window.onload = function () {
    'use strict';

    setTimeout(function () {
        const entries = window.performance.getEntries();
        const t = entries[0];
        console.log(t);

        const stages = {
            'dns': t.domainLookupEnd - t.domainLookupStart,
            'connect': t.connectEnd - t.connectStart,
            'ssl': t.secureConnectionStart === 0 ? 0 : t.connectEnd - t.secureConnectionStart,
            'wait': t.responseStart - t.requestStart,
            'receive': t.responseEnd - t.responseStart,
            'render': t.domComplete - t.responseEnd,
            'total_response': t.responseEnd - t.requestStart
        };

        Object.entries(stages).forEach(
            function ([key, value]) {
                let timeCol = document.getElementById(`pm_${key}_time`);
                timeCol.innerHTML = value.toFixed(1) + '<span>ms</span>';
            }
        );

        const events = {
            'first_byte': t.responseStart,
            'dom_interactive': t.domInteractive,
            'dom_content_loaded': t.domContentLoadedEventEnd,
            'dom_complete': t.domComplete,
            'loaded': t.loadEventEnd
        };

        Object.entries(events).forEach(
            function ([key, value]) {
                let timeCol = document.getElementById(`pm_${key}_time`);
                timeCol.innerHTML = '<span>@</span>' + value.toFixed(1) + '<span>ms</span>';
            }
        );
    }, 10);
};
