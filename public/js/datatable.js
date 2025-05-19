$(document).ready(function () {
    var dataTable = $('#data_table').DataTable({
        lengthMenu: [
            // [20, 50, 100, -1],
            // [20, 50, 100, 'ทั้งหมด']
            [10, 40, 80, -1],
            [10, 40, 80, 'ทั้งหมด']
        ],
        language: {
            processing: "กำลังดำเนินการ...",
            search: "ค้นหา :",
            lengthMenu: "แสดง _MENU_ รายการ",
            info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            infoEmpty: "ไม่มีข้อมูล",
            infoFiltered: "(กรองข้อมูล _MAX_ รายการทั้งหมด)",
            infoPostFix: "",
            loadingRecords: "กำลังโหลดข้อมูล...",
            zeroRecords: "ไม่พบข้อมูล",
            emptyTable: "ไม่มีข้อมูล",
            paginate: {
                first: "หน้าแรก",
                previous: "ก่อนหน้า",
                next: "ถัดไป",
                last: "หน้าสุดท้าย",
            },
        },
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const dateColumns = document.querySelectorAll('.date-column');
    dateColumns.forEach(function(cell) {
        const dateText = cell.textContent.trim();
        const dateParts = dateText.split('-');
        if (dateParts.length === 3) {
            let year = parseInt(dateParts[0], 10);
            const month = dateParts[1];
            const day = dateParts[2];
            year += 543;
            cell.textContent = `${day}/${month}/${year}`;
        }
    });
});
