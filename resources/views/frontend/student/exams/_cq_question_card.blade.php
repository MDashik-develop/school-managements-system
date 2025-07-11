<div class="bg-white p-8 shadow-xl rounded-xl mb-6"> 
   <form id="cq-form" action="{{ route('student.exams.submit.cq', $exam->id) }}" method="POST" enctype="multipart/form-data">
       @csrf
       <input type="hidden" name="question_id" value="{{ $nextQuestion->id }}">

       <div class="mb-4">
           <h2 class="text-xl font-semibold text-gray-800">Question:</h2>
           <p class="text-gray-700 mt-2">{!! $nextQuestion->question_text !!}</p>
           @if($nextQuestion->attachment)
               <img src="{{ asset('storage/' . $nextQuestion->attachment) }}" alt="Attachment" class="mt-4 rounded-xl">
           @endif
       </div>

       <div class="mb-4">
           <label for="answer_text" class="block text-gray-600 font-medium mb-1">Write Your Answer:</label>
           <textarea name="answer_text" id="answer_text" rows="6" class="longText w-full p-4 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300"></textarea>
       </div>

       <div class="mb-4">
           <label class="block text-gray-600 font-medium mb-1">Optional Attachment:</label>
           <input type="file" name="attachment" id="attachment" class="longText block w-full border border-gray-300 rounded-md p-2">
           <div id="image-preview" class="mt-3"></div>
       </div>

       <div class="text-right">
           <button type="submit" class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-indigo-700 transition-all">
               Submit Answer
           </button>
       </div>
   </form>
</div>

<script>
document.getElementById('attachment').addEventListener('change', function(event) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.setAttribute('src', e.target.result);
            img.setAttribute('class', 'mt-2 rounded-lg border border-gray-300 max-h-48');
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    }
});
</script>
