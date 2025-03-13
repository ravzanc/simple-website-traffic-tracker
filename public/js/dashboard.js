async function fetchStats()
{
    const pageUrl = document.getElementById('pageUrl').value;
    const startDate = document.getElementById('startDate').value.replace('T', ' ');
    const endDate = document.getElementById('endDate').value.replace('T', ' ');
    const timeZoneOffset = new Date().getTimezoneOffset() / 60;

    const response = await fetch(
        `http://127.0.0.1:8000/api/visits?pageUrl=${pageUrl}&startDate=${startDate}&endDate=${endDate}&tzDate=${timeZoneOffset}`
    );
    const result = await response.json();

    const resultBody = document.getElementById('result') ;
    resultBody.innerHTML = '';

    for (let pos in result.data) {
        let trBody = document.createElement('tr');
        let thItem = document.createElement('th');
        let tdItem = document.createElement('td');

        thItem.innerText = result.data[pos].context;
        tdItem.innerText = result.data[pos].value;

        trBody.appendChild(thItem);
        trBody.appendChild(tdItem);

        resultBody.appendChild(trBody);
    }
}
