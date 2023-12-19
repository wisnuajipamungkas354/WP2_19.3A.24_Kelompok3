let Nomor = 1
$(document).ready(function(){
        $('.selectpicker').selectpicker();
        $('#tombol-add').on('click', function(){
            var nilai = $('#drop_list').val();
            $.ajax({
                type : "GET",
                url : "<?"
            })
            markup = "<tr><td>" + Nomor  + "</td><td>" + $('#drop_list').val() + "</td><td>" + "</td><td> <button>Hapus</button></td>";
            
            tableBody = $('table tbody');
            tableBody.append(markup);
            Nomor++;
        })
    })

