document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-book');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = './php/validations/book/delete_book.php';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'book_id';
            input.value = button.getAttribute('data-book-id');

            form.appendChild(input);

            Swal.fire({
                title: "Deleting a book removes all related comments and notes by users",
                text: "Once deleted, you will not be able to recover this book!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                html: form,
                preConfirm: () => {
                    form.submit();
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire("Your book is safe!", {
                        icon: "info"
                    });
                }
            });
        });
    });
});
