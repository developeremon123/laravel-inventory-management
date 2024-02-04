<div class="modal fade" id="store_or_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-white" id="model-1"></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            </div>
            <form method="POST" id="store_or_update_form">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="update_id" id="update_id">
                        <x-form.textbox labelName="Menu Name" col="col-md-12" name="menu_name" required="required"
                            placeholder="Enter menu name" />
                        <x-form.selectbox labelName="Deletable" col="col-md-12" name="deletable" class="select"
                            required="required">
                            @foreach (DELETABLE as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </x-form.selectbox>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_btn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
