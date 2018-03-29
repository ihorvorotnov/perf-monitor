window.onload = function () {
    'use strict';

    setTimeout(function () {
        const entries = window.performance.getEntries();
        const t = entries[0];
        console.log(t);

        const data = {
            'dns': t.domainLookupEnd - t.domainLookupStart,
            'connect': t.connectEnd - t.connectStart,
            'ssl': t.secureConnectionStart === 0 ? 0 : t.connectEnd - t.secureConnectionStart,
            'wait': t.responseStart - t.requestStart,
            'receive': t.responseEnd - t.responseStart,
            'render': t.domComplete - t.responseEnd,
            'total_response': t.responseEnd - t.requestStart,
            'domloaded': t.domContentLoadedEventEnd,
            'loaded': t.loadEventEnd
        };

        Object.entries(data).forEach(
            function ([key, value]) {
                let timeCol = document.getElementById(`pm_${key}_time`);
                timeCol.innerHTML = value.toFixed(1) + '<span>ms</span>';
            }
        );
    }, 10);
};
