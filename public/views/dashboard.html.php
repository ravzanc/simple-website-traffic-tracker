<?php global $pages; ?>

<h1>My Dashboard</h1>

<form onsubmit="return false">
    <label for="pageUrl">Page: </label>
    <select id="pageUrl">
        <option value="">Choose a visited page</option>
        <?php foreach ($pages as $item) : ?>
        <option value="<?php echo $item['page_url']; ?>"><?php echo $item['page_url']; ?></option>
        <?php endforeach; ?>
    </select>

    <input type="hidden" id="datetime-zone" value="" />

    <label for="startDate">From: </label>
    <input type="datetime-local" id="startDate" />
    <span class="validity"></span>

    <label for="endDate">To: </label>
    <input type="datetime-local" id="endDate" />
    <span class="validity"></span>

    <label></label>
    <button onclick="fetchStats()">Get Stats</button>
</form>

<table>
    <thead>
        <tr>
            <th>Context</th>
            <th>Unique Visitors</th>
        </tr>
    </thead>
    <tbody id="result">
    </tbody>
</table>
