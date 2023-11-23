<script type="text/javascript" charset="utf-8" src="js/city_filter.js"></script>

<h1>PHP Test Application</h1>

<label for="filterInput">Filter by City:</label>
<input type="text" id="filterInput" onkeyup="cityFilter()" placeholder="Filter city...">

<table id="userTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>E-mail</th>
        <th>City</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as &$user): ?>
        <tr>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getCity() ?></td>
            <td><?= $user->getPhone() ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- TODO: add frontend validation here -->
<form method="post" action="create.php">

    <label for="name">Name:</label>
    <input name="name" input="text" id="name"/>

    <label for="email">E-mail:</label>
    <input name="email" input="text" id="email"/>

    <label for="city">City:</label>
    <input name="city" input="text" id="city"/>

    <label for="phone">Phone:</label>
    <input name="phone" input="text" id="phone"/>

    <button>Create new row</button>
</form>