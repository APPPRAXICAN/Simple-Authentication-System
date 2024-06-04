async function refresh(){
    path = "/websites/subsytems/login-registration-subsystem/backend/Captcha-System/captcha-sub-server.php"
    try{
        response = await fetch(path ,
            {
                method:"GET",
                headers:{
                    'Content-Type': 'application/json'},
            }
        )
        result = await response.json()
        console.log(result)
        img = document.getElementById("captcha-img")
        img.src = result.path
    }
    catch(err){
        console.log("err " , err);
    }
}
console.log('refresh')