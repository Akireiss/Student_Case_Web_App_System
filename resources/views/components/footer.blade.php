
<footer id="footer" class="flex justify-center py-5 align-center px-5">
    <span class="block text-sm text-gray-700 sm:text-center dark:text-gray-400 bottom-0 text-center">© 2023 <a
        href="https://github.com/Akireiss/Student_Web_Case_CZCMHS" target="_blank" class="hover:underline text-center">
        Capstone Project</a> | Don Mariano Marcos Memorial State University</span>
</footer>

     @push('scripts')
     <script>
        $(document).ready(function() {
          $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
              $("#footer").show(); // Show the footer when the user reaches the end of the page
            } else {
              $("#footer").hide(); // Hide the footer when the user is not at the end of the page
            }
          });
        });
        </script>

     @endpush
