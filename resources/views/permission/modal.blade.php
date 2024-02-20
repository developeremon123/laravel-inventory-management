<div class="modal fade" id="store_or_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                        <x-form.selectbox labelName="Module" col="col-md-12" name="module_id" class="selectpicker"
                            required="required">
                            @if (!empty($data['modules']))
                                @foreach ($data['modules'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </x-form.selectbox>
                        <div class="col-md-12">
                            <table class="table table-borderless" id="permission_table">
                                <thead class="bg-primary">
                                    <th width="45%">Permission Name</th>
                                    <th width="45%">Permission Slug</th>
                                    <th width="10%"></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="permission[1][name]" onkeyup="url_generator(this.value,'permission_1_slug')" id="permission_1_name" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="permission[1][slug]" id="permission_1_slug" class="form-control">
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" type="button" id="add_permission" data-toggle="tooltip" data-placement="top" data-original-title="Add More">
                                                <i class="fa-solid fa-square-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
