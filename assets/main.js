$(document).ready(function() {
    let currentInput = '';
    let fullExpression = '';
    let lastResult = '';

    $('.btn').click(function() {
        let value = $(this).text();

        if ($.isNumeric(value) || value === '.') {
            currentInput += value;
            fullExpression += value;
            $('.display').text(fullExpression);
        } else if (value === 'C') {
            currentInput = '';
            fullExpression = '';
            $('.display').text('0');
        } else if (value === '=') {
            if (fullExpression.trim().length > 0 && ['+', '-', '*', '/'].includes(fullExpression.slice(-1))) {
                fullExpression = fullExpression.slice(0, -1);
            }

            if (fullExpression !== '') {
                let parts = fullExpression.split(/([+\-*/])/);
                let numbers = [];

                for (let i = 0; i < parts.length; i++) {
                    let part = parts[i].trim();
                    if (part) {
                        numbers.push(part);
                    }
                }

                $.ajax({
                    url: 'calcusaver.php',
                    type: 'POST',
                    data: {
                        numbers: numbers
                    },
                    success: function(response) {
                        let data = response.result;
                        $('.display').text(data || 'Err');
                        currentInput = '';
                        lastResult = data; // Sonucu saklama
                    }
                });
            }
        } else {
            if (currentInput !== '' || (value === '-' && fullExpression === '')) {
                if (['+', '-', '*', '/'].includes(fullExpression.slice(-1))) {
                    fullExpression = fullExpression.slice(0, -1);
                }
                fullExpression += value;
                $('.display').text(fullExpression);
                currentInput = '';
            }
        }
    });

    $('.btn-save').click(function() {
        if (lastResult !== '' && fullExpression !== '') {
            $.ajax({
                url: 'calcusaver.php',
                type: 'POST',
                data: {
                    save: 'true',
                    expression: fullExpression,
                    result: lastResult
                },
                success: function(response) {
                    if (response.status == 'success') {
                        alert('İşlem başarıyla kaydedildi.');

                        // sayfa yenilenmeden son kaydedilen işlemi direkt tabloya ekletiyoruz
                        let tableBody = $('.custom-table-container tbody');
                        let newRow = `
                            <tr>
                                <td>${fullExpression}</td>
                                <td>${lastResult}</td>
                            </tr>
                        `;
                        tableBody.append(newRow); // sonuna ekliyoruz
                    } else {
                        alert('İşlem kaydedilemedi.');
                    }
                }
            });
        } else {
            alert('Kaydedilecek bir işlem yok');
        }
    });
});
