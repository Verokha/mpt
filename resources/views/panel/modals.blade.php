<div class="modal fade" id="modal-accept" tabindex="-1" aria-labelledby="modal-accept-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-accept-label">Принять это заявление?</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn w-25 seconadary action_select" data-bs-dismiss="modal">Нет</button>
        <button type="button" class="btn w-25 primary action_select" id="acceptAction">Да</button>
        <div class="d-none action_load">
          <button class="btn neutral" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Отправка...
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-confirm" tabindex="-1" aria-labelledby="modal-confirm-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-confirm-label">Подтвердить заявление?</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn w-25 seconadary action_select" data-bs-dismiss="modal">Нет</button>
        <button type="button" class="btn w-25 primary action_select" id="acceptConfirm">Да</button>
        <div class="d-none action_load">
          <button class="btn neutral" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Отправка...
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-reject" tabindex="-1" aria-labelledby="modal-reject-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal-reject-label">Отклонение заявления</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="cause" class="form-label">Укажите причину отклонения:</label>
                <textarea class="form-control" id="cause" rows="3" style="resize: none;"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn neutral action_select" id="rejectAction">Подтвердить</button>
            <div class="d-none action_load">
                <button class="btn neutral" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Отправка...
                </button>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-result" tabindex="-1" aria-labelledby="modal-result-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-result-label"></h1>
      </div>
      <div class="modal-body">
            <div class="mb-3">
                <p id="resultMessage"></p>
            </div>
        </div>
      <div class="modal-footer">
        <a href="javascript:window.location.reload();" type="button" class="btn neutral">Подтвердить</a>
      </div>
    </div>
  </div>
</div>
