<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    <br/>
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <button onclick="SentOTP()"  class="btn w-100 float-end bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    async function SentOTP(){

        let email = document.getElementById('email').value

        let postBody = {
            "email": email
        }

        showLoader()
        let res = await axios.post('/send-otp', postBody)
        hideLoader()

        if(res.data['status'] == "success"){

            localStorage.setItem('email', email)

            successToast(res.data['message'])

            setTimeout(() => {
                window.location.href = "/verifyOtp"
            }, 1000);
        }else{
            errorToast(res.data['message'])
        }
    }


</script>
<?php /**PATH D:\Laravel\Laravel Laptop\0 modules\0 Mega Project (m14 - m18)\POS\resources\views/components/auth/send-otp-form.blade.php ENDPATH**/ ?>