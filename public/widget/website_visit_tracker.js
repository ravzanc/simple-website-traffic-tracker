(function () {
    // Generate or retrieve a unique visitor ID in the website page context
    const visitorContext = 'visitor-' + window.location.pathname.substring(1) + '-id';
    // The visitor ID value is changing within the current timestamp every 10 seconds
    let visitorId = Date.now().toString().substring(0, 9);

    // Given the visitor ID value expires every 10 seconds
    if (visitorId !== localStorage.getItem(visitorContext)) {
        // Then refresh the visitor ID value
        localStorage.setItem(visitorContext, visitorId);

        // Prepare data to send
        const data = {
            visitorId: visitorId,
            pageUrl: window.location.href,
            visitTime: new Date().toISOString().slice(0, 19).replace('T', ' ')
        };

        // The visitor ID value is tracked as unique visitor of the current page
        fetch('http://127.0.0.1:8000/api/visits', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
    }
})();