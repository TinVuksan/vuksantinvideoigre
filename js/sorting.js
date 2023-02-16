const archiveOrderby = document.getElementById('orderby');
const archiveOrder = document.getElementById('order');

if(archiveOrder && archiveOrderby) {
    const setOrder = () => {
        const orderBy = archiveOrderby.options[archiveOrderby.selectedIndex].value;

        if('title' == orderBy) {
            archiveOrder.value = 'ASC';
        } else {
            archiveOrder.value = 'DESC';
        }
    }

    archiveOrderby.addEventListener('change', setOrder);

    setOrder();
}