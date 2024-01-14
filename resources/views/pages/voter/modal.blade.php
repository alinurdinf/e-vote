  @push('js')
    <script>
        $(document).ready(function() {
            $('.detail-link').click(function() {
                var index = $(this).data('index');
                var candidate = {!! json_encode($data) !!}[index];

                $('#candidateName').text(candidate.name);
                $('#tagline').text(candidate.tagline);
                $('#visi').text(candidate.visi);
                $('#misi').text(candidate.misi);
            });
        });

    </script>

    @endpush

    <!-- Modal Stisla -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Candidate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="candidateName"></h4>
                <p id="tagline"></p>
                <h5>Visi:</h5>
                <p id="visi"></p>
                <h5>Misi:</h5>
                <p id="misi"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>