<form class="row g-3 contact-form bingo-form" action="<?= url('/form/contact') ?>" method="post">
    <div class="col-md-6">
        <label for="contactEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="contactEmail" name="email">
    </div>
    <div class="col-md-6">
        <label for="contactName" class="form-label">Name</label>
        <input type="text" class="form-control" id="contactName" name="name">
    </div>
    <div class="col-12">
        <label for="contactAddress" class="form-label">Address</label>
        <input type="text" class="form-control" id="contactAddress" name="address">
    </div>
    <div class="col-md-6">
        <label for="contactCity" class="form-label">City</label>
        <input type="text" class="form-control" id="contactCity" name="city">
    </div>
    <div class="col-md-4">
        <label for="contactState" class="form-label">State</label>
        <select id="contactState" class="form-select" name="state">
            <option selected>Choose...</option>
            <option>...</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="contactZip" class="form-label">Zip</label>
        <input type="text" class="form-control" id="contactZip" name="zip">
    </div>

    <div class="col-md-6">
        <label>Gender</label>
        <div class="check-group mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="保密"
                       checked>
                <label class="form-check-label" for="inlineRadio1">保密</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="男">
                <label class="form-check-label" for="inlineRadio2">男</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="女">
                <label class="form-check-label" for="inlineRadio3">女</label>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label>Interests</label>
        <div class="check-group mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="閱讀">
                <label class="form-check-label" for="inlineCheckbox1">閱讀</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                <label class="form-check-label" for="inlineCheckbox2">運動</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="運動">
                <label class="form-check-label" for="inlineCheckbox3">音樂</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="武術">
                <label class="form-check-label" for="inlineCheckbox4">武術</label>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <label for="contactMessage" class="form-label">Message</label>
        <textarea class="form-control" id="contactMessage" rows="3" name="message"></textarea>
    </div>
    <div class="col-md-12">
        <label for="contactFiles" class="form-label">Files</label>
        <input class="form-control" type="file" id="contactFiles" multiple name="files">
    </div>
    <div class="col-md-6">
        <label for="contactCaptcha" class="form-label">Captcha</label>
        <div class="d-flex">
            <input type="text" class="form-control" id="contactCaptcha" name="captcha">
            <img src="<?= url('/captcha.jpg') ?>" alt="" height="38" class="captcha" title="看不清? 點擊更換...">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
                隱私協議
            </label>
        </div>
    </div>
    <div class="col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
</form>
