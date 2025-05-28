@extends('admin.layout.layout')
@section('admin_content')
<div class="container">
    <h2 class="text-center mb-4">แบบคำร้องขอจัดตั้งตลาดเอกชน</h2><br>

    <form action="{{route('PrivateMarketAdminCalendarSave')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-3">
            <div class="col-md-7">
                <label for="title" class="form-label">หัวข้อ :</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="col-md-7">
                <label for="detail" class="form-label">รายละเอียด :</label>
                <input type="text" class="form-control" id="detail" name="detail">
            </div>
            <div class="col-md-7">
                <label for="admin_date" class="form-label">นัดหมาย :</label>
                <input type="datetime-local" class="form-control" name="date_admin" id="date_admin">
            </div>
        </div>
        <button type="submit" class="btn btn-primary py-1"><i class="fa fa-save"></i></i> บันทึกข้อมูล</button>
        <input type="hidden" name="id" value="{{ old('id', $form->id) }}">
    </form>
</div>

<script src="{{asset('js/multipart_files.js')}}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
