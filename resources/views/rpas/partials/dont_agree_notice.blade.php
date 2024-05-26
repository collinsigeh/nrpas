<div class="modal fade" id="dontAgreeNotice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dontAgreeNoticeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dontAgreeNoticeLabel">Safety Requirements</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-info">
                Please note that you need to agree with every item on the safety agreement before you can register your RPAS (drone).
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="my-custom-secondary-btn" data-bs-dismiss="modal">Back</button>
          <a href="{{ route('dashboard') }}" class="my-custom-primary-btn">Cancel Process</a>
        </div>
      </div>
    </div>
</div>