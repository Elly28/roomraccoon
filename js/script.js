document.addEventListener('DOMContentLoaded', () => {
    const itemForm = document.getElementById('item-form');
    const itemNameInput = document.getElementById('item-name');
    const itemList = document.getElementById('item-list');

    itemForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const itemName = itemNameInput.value.trim();
        if (itemName !== '') {
            fetch('/shopping-list/index.php?action=create', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `name=${itemName}`
            }).then(() => location.reload());
        }
    });

    itemList.addEventListener('click', (e) => {
        const target = e.target;
        const li = target.closest('li');
        const id = li.dataset.id;

        if (target.classList.contains('delete-button')) {
            fetch(`/shopping-list/index.php?action=delete&id=${id}`, {
                method: 'POST'
            }).then(() => location.reload());
        } else if (target.classList.contains('edit-button')) {
            const itemName = li.querySelector('.item-name').textContent;
            const newName = prompt('Edit item name:', itemName);
            if (newName && newName.trim() !== '') {
                fetch(`/shopping-list/index.php?action=update&id=${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `name=${newName}&checked=${li.querySelector('.item-checkbox').checked}`
                }).then(() => location.reload());
            }
        } else if (target.classList.contains('item-checkbox')) {
            fetch(`/shopping-list/index.php?action=update&id=${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `name=${li.querySelector('.item-name').textContent}&checked=${target.checked}`
            });
        }
    });
});
