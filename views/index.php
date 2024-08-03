<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Raccoon Shopping List</title>
    <link rel="stylesheet" href="/room_raccoon/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="/room_raccoon/js/scripts.js"></script> -->
</head>

<body>
    <div class="container">
        <h1>Room Raccoon Shopping List</h1>
        <form id="item-form">
            <input type="text" id="item-name" placeholder="Add new item" required>
            <button type="submit">Add</button>
        </form>
        <ul id="item-list">
            <?php foreach ($items as $item): ?>
            <li data-id="<?= $item['id'] ?>">
                <input type="checkbox" class="item-checkbox" <?= $item['checked'] ? 'checked' : '' ?>>
                <span class="item-name"><?= $item['name'] ?></span>
                <button class="edit-button">Edit</button>
                <button class="delete-button">Delete</button>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const itemForm = document.getElementById('item-form');
            const itemNameInput = document.getElementById('item-name');
            const itemList = document.getElementById('item-list');

            itemForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const itemName = itemNameInput.value.trim();
                if (itemName !== '') {
                    fetch('/room_raccoon/index.php?action=create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `name=${itemName}`
                    }).then(() => location.reload());
                }
            });

            itemList.addEventListener('click', (e) => {
                const target = e.target;
                const li = target.closest('li');
                const id = li.dataset.id;

                if (target.classList.contains('delete-button')) {
                    fetch(`/room_raccoon/index.php?action=delete&id=${id}`, {
                        method: 'POST'
                    }).then(() => location.reload());
                } else if (target.classList.contains('edit-button')) {
                    const itemName = li.querySelector('.item-name').textContent;
                    const newName = prompt('Edit item name:', itemName);
                    if (newName && newName.trim() !== '') {
                        fetch(`/room_raccoon/index.php?action=update&id=${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `name=${newName}&checked=${li.querySelector('.item-checkbox').checked}`
                        }).then(() => location.reload());
                    }
                } else if (target.classList.contains('item-checkbox')) {
                    fetch(`/room_raccoon/index.php?action=update&id=${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `name=${li.querySelector('.item-name').textContent}&checked=${target.checked}`
                    });
                }
            });
        });
    </script>
</body>

</html>
