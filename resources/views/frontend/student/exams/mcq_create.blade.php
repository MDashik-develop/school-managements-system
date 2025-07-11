@extends('layouts.student')

@section('styles')
{{-- Google Fonts Link --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Custom Styles and Animations */
    body {
        font-family: 'Hind Siliguri', sans-serif;
        background-color: #f0f2f5; /* Light gray background for better contrast */
    }

    /* --- Animation Classes --- */
    .question-card-enter {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.4s ease-out, transform 0.4s ease-out;
    }

    .question-card-exit {
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.3s ease-in, transform 0.3s ease-in;
    }

    .question-card-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* --- Button Loading Animation --- */
    .btn-loading {
        position: relative;
        color: transparent !important;
        cursor: not-allowed;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        margin-top: -8px;
        margin-left: -8px;
        width: 16px;
        height: 16px;
        border: 2px solid #fff;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div id="exam-container" class="w-full max-w-2xl">
        {{-- The first question will be loaded here initially --}}
        @include('frontend.student.exams._question_card', ['question' => $question])
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {
    // Make the first question card visible with animation
    if ($('#mcq-form').length) {
        setTimeout(function() {
            $('#mcq-form').parent().addClass('question-card-visible');
        }, 100);
    }

    $(document).on('submit', '#mcq-form', function (e) {
        e.preventDefault();
        
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        var formData = new FormData(this);
        var actionUrl = form.attr('action');

        // Add loading animation to the button
        submitButton.addClass('btn-loading').prop('disabled', true);

        // Animate out the current question
        form.parent().removeClass('question-card-visible').addClass('question-card-exit');
        
        // Wait for the exit animation to complete before making the AJAX call
        setTimeout(function() {
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
                    var newHtml;
                    if (data.status === 'next') {
                        newHtml = data.html;
                    } else if (data.status === 'done') {
                     newHtml = `
                                 <div class="text-center bg-white shadow-xl rounded-2xl p-12 transition-all duration-500 question-card-enter">
                                    <div class="text-green-500 mb-4">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                                          stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                       </svg>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                       ${data.examScores}
                                    </h2>
                                    <h2 class="text-2xl font-bold text-gray-800">✅ Completed!</h2>
                                 </div>
                                 `;
                    } else {
                        // Fallback for unexpected responses
                        newHtml = '<div class="p-8 text-center text-red-700 font-bold text-xl">An unexpected error occurred.</div>';
                    }

                    // Replace the content and animate in the new content
                    var $examContainer = $('#exam-container');
                    $examContainer.html(newHtml);
                    
                    setTimeout(function() {
                        $examContainer.find('.question-card-enter').addClass('question-card-visible');
                    }, 50); // A short delay ensures the transition triggers correctly
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error: ' + error);
                    // In case of an error, restore the button and bring back the form
                    submitButton.removeClass('btn-loading').prop('disabled', false);
                    form.parent().addClass('question-card-visible').removeClass('question-card-exit');
                }
            });
        }, 350); // This timeout should match the CSS transition duration for the exit animation
    });
});
</script>
@endsection