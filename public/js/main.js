const comandas = document.getElementById('comandas');

if (comandas) {
    comandas.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-article') {
            if (confirm('Estàs segur?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/comanda/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}

const customers = document.getElementById('customers');

if (customers) {
    customers.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-article') {
            if (confirm('Estàs segur?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/customers/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}