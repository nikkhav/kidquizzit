<div class="modal fade create-modal" id="personal-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yeni Personal Məlumatları</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="image-box">
                                        <img id="profil-fotografi-goster" class="imgPreview profil-fotografi-goster"
                                            src="https://png.pngtree.com/png-vector/20191009/ourlarge/pngtree-user-icon-png-image_1796659.jpg"
                                            alt="Varsayılan Profil Fotoğrafı" width="150" height="150">
                                            <div class="file-upload">
                                                <label for="profil-fotografi">
                                                    <span>Şəkil seçin</span>
                                                </label>
                                                <input type="file" id="profil-fotografi" class="profil-fotografi" name="file"
                                                accept="image/*">
                                            </div>
                                    </div>
                                  

                                </div>
                                <div class="col-md-8">
                                    <div class="inputs-list-flex-column d-flex flex-column gap-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="department_id"> Departament</label>
                                                <select name="department_id" id="department_id"
                                                    class=" form-control w-1100" required>
                                                    <option value="" selected disabled>Seçin... </option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="position_id">Vəzifə</label>
                                                <select name="position_id" id="position_id" class="  form-control"
                                                    required>
                                                    <option value="" selected disabled>Seçin... </option>
                                                    @foreach ($postions as $postion)
                                                        <option value="{{ $postion->id }}">{{ $postion->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="department_id">İcazə</label>
                                                <select name="role_id" id="role_id" class=" form-control" required>
                                                    <option value="" selected disabled>Seçin... </option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pt-3">
                            <div class="form-group">
                                <label for="name">Ad</label>
                                <input type="text" name="name" id="name" class="form-control"
                                     aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-4 pt-3">
                            <div class="form-group">
                                <label for="sername">Soyad</label>
                                <input type="text" id="surname" name="surname" class="form-control"
                                     aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-4 pt-3">
                            <div class="form-group">
                                <label for="sername">Cins</label>
                                <select class="form-control" name="gender" data-choices data-choices-search-false id="ticket-status">
                                    <option value="" selected disabled>Seçin... </option>
                                    <option value="1">Kişi</option>
                                    <option value="0">Qadın</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="email">İmeyl Ünvanı</label>
                                <input type="email" name="email" id="email" class="form-control"
                                   aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group position-relative-switch">
                                <label for="password">Telefon</label>
                                <div class="whatsapp-switch">
                                    <input type="checkbox" name="whatsapp"  id="whatsapp" style="display:none;">
                                    <label for="whatsapp-switch"><i class="fab fa-whatsapp"></i> <span>Active</span></label>
                                  </div>
                                  
                                <input type="text" id="phone" name="phone" class="form-control phone"
                                    placeholder="+994 00 000 00 00" aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="sername">Təvəllüd (ay/gün/il)</label>
                                <input type="date" id="birthday" name="birthday" class="form-control"
                                    aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="sername">Ünvan</label>
                                <input type="text" id="adress" name="address" class="form-control" 
                                    aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="password">Şifr</label>
                                <input type="text" id="password" name="password" class="form-control"
                                   aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="password"> Şifr Təkrar</label>
                                <input type="text" id="password-confirm" name="password_confirmation" class="form-control"
                                   aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control mt-4" name="info" id="info" id="exampleFormControlTextarea1" rows="3"
                                placeholder="İstifadəçi haqqında əlavə məlumat əlavə edin."></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">İmtina et</button>
                <button type="button" class="btn btn-success " id="save-personal">Əlavə et</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="personal-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content modal-lg personal-modal-edit-content">
           
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personal-edit-modal">Personal Məlumatları</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" enctype="multipart/form-data">
                    <input type="hidden" name="edit-id" id="edit-id"  value="">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="image-box">
                                        <img id="edit-profil-fotografi-goster" class="imgPreview profil-fotografi-goster"
                                            src="https://png.pngtree.com/png-vector/20191009/ourlarge/pngtree-user-icon-png-image_1796659.jpg"
                                            alt="Varsayılan Profil Fotoğrafı" width="150" height="150">
                                            <div class="file-upload">
                                                <label for="edit-profil-fotografi">
                                                    <span>Şəkil seçin</span>
                                                </label>
                                                <input type="file" id="edit-profil-fotografi" class="profil-fotografi" name="file"
                                                accept="image/*">
                                            </div>
                                    </div>
                          

                                </div>
                                
                                <div class="col-md-8">
                                    <div class="inputs-list-flex-column d-flex flex-column gap-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=" department_id"> Departament</label>
                                                <select name="department_id" id="department_id"
                                                    class=" form-control w-1100" required>
                                                    <option value="" selected disabled>Seçin... </option>

                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}" >
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="position_id">Vəzifə</label>
                                                <select name="position_id" id="position_id" class="  form-control"
                                                    required>
                                                    <option value=""selected disabled>Seçin... </option>
                                                    @foreach ($postions as $postion)
                                                        <option value="{{ $postion->id }}">{{ $postion->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="department_id">İcazə</label>
                                                <select name="role_id" id="role_id" class=" form-control" required>
                                                    <option value=""selected disabled>Seçin... </option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pt-3">
                            <div class="form-group">
                                <label for="name">Ad</label>
                                <input type="text" name="name" id="name" value="" class="form-control"
                                   aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-4 pt-3">
                            <div class="form-group">
                                <label for="sername">Soyad</label>
                                <input type="text" id="surname" name="surname" value=""  class="form-control"
                                   aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-4 pt-3">
                            <div class="form-group">
                                <label for="sername">Cins</label>
                                <select class="form-control" name="gender" id="gender" data-choices data-choices-search-false id="ticket-status">
                                    <option value="" selected disabled>Seçin... </option>
                                    <option value="1">Kişi</option>
                                    <option value="0">Qadın</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="email">İmeyl Ünvanı</label>
                                <input type="email" name="email" id="email" value=""  class="form-control"
                                   aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group position-relative-switch">
                                <label for="password">Telefon</label>
                                <div class="whatsapp-switch">
                                    <input type="checkbox" name=" whatsapp"  id="whatsapp-switch" style="display:none;">
                                    <label for="whatsapp-switch"><i class="fab fa-whatsapp"></i> <span>Active</span></label>
                                  </div>
                                  
                                <input type="text" id="phone" name="phone" value=""  class="form-control phone"
                                    placeholder="+994 00 000 00 00" aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="sername">Təvəllüd (ay/gün/il)</label>
                                <input type="date" id="birthday" name="birthday" value=""  autocomplete="off" class="form-control birthday" 
                                    aria-describedby="helpId" required>
                             
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="sername">Ünvan</label>
                                <input type="text" id="address" name="address" value=""  class="form-control" 
                                    aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="password">Şifr</label>
                                <input type="text" id="password" name="password" class="form-control"
                                 aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div class="form-group">
                                <label for="password"> Şifr Təkrar</label>
                                <input type="text" id="password-confirm" name="password_confirmation" class="form-control"
                                    aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control mt-4" name="info" id="info" id="exampleFormControlTextarea1" rows="3"
                                placeholder="İstifadəçi haqqında əlavə məlumat əlavə edin"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">İmtina et</button>
                <button type="button" class="btn btn-success " id="edit-position">Redaktə et</button>
                </form>
            </div>
        </div>

        </div>
    </div>
</div>
