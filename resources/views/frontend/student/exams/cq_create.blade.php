@extends('layouts.student')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div id="cq-exam-container" class="w-full max-w-3xl">
        @include('frontend.student.exams._cq_question_card', ['nextQuestion' => $question, 'exam' => $exam])
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    
    
    $(document).ready(function() {
         $('.longText').summernote();
    });
    
$(document).on('submit', '#cq-form', function (e) {
    e.preventDefault();

    var form = $(this);
    var formData = new FormData(this);
    var actionUrl = form.attr('action');

    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.status === 'next') {
                $('#cq-exam-container').html(data.html);
            } else if (data.status === 'done') {
                $('#cq-exam-container').html(`
                    <div class="bg-white p-10 text-center rounded-xl shadow-lg">
                        <h2 class="text-2xl font-bold text-green-600 mb-4">✅ Completed!</h2>
                        <p class="text-gray-700">All questions submitted successfully. Thank you!</p>
                    </div>
                `);
            }
        },
        error: function (xhr) {
            alert('An error occurred.');
            console.error(xhr.responseText);
        }
    });
});
</script>
@endsection
