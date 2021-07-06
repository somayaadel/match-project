// axios
import axios from "axios";

const domain = "";

export default axios.create({

    domain,
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: "Bearer " + (localStorage.getItem("accessToken") ?
        localStorage.getItem("accessToken") :
        "") , 
        "application-key":"AdminVerySecretXD"
    }
});
