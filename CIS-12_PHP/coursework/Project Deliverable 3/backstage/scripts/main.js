const modal = document.getElementById('loginSignupModal');
const span = document.getElementsByClassName("close")[0];
const btn = document.getElementById('logInOut');

btn.onclick = () => {
    if(document.getElementById('logInOut').innerText !== 'LOGOUT') {
        modal.style.display = "block";
    }
}

span.onclick = () => {
    modal.style.display = "none";
}

window.onclick = (event) => {
    if(event.target === modal) {
        modal.style.display = "none";
    }
}

document.getElementById('toggleLogin').addEventListener('click', () => {
    if(document.getElementById('loginActive').value === "1") {
        document.getElementById('loginActive').value = "0";
        document.getElementById('loginForm').style.display = "none";
        document.getElementById('signupForm').style.display = "block";
        document.getElementById('toggleLogin').innerHTML = "LOGIN";
    } else {
        document.getElementById('loginActive').value = "1";
        document.getElementById('loginForm').style.display = "block";
        document.getElementById('signupForm').style.display = "none";
        document.getElementById('toggleLogin').innerHTML = "SIGNUP";
    }
});

document.getElementById('loginSignupButton').addEventListener('click', async () => {
    await fetch('./controllers/login.php', {
        method: 'POST',
        data: "email=" + document.getElementById('email').value +
            "&password=" + document.getElementById('loginPassword').value +
            "&loginActive=" + document.getElementById('loginActive').value,
        success: (response) => {
            if (response.status === 200) {
                window.location.href = "./index.php";
            } else {
                alert("Invalid email or password");
            }
        }
    });
});

document.getElementsByClassName('toggle-follow')[0].addEventListener('click', async () => {
    await fetch('./controllers/follow.php', {
        method: 'POST',
        data: "userId=" + document.getElementsByClassName('toggle-follow')[0].getAttribute('data-user-id') +
            "&follow=" + document.getElementsByClassName('toggle-follow')[0].getAttribute('data-follow'),
        success: (response) => {
            if (response.status === 200) {
                if(document.getElementsByClassName('toggle-follow')[0].getAttribute('data-follow') === "1") {
                    document.getElementsByClassName('toggle-follow')[0].setAttribute('data-follow', "0");
                    document.getElementsByClassName('toggle-follow')[0].innerHTML = "Follow";
                } else {
                    document.getElementsByClassName('toggle-follow')[0].setAttribute('data-follow', "1");
                    document.getElementsByClassName('toggle-follow')[0].innerHTML = "Unfollow";
                }
            } else {
                alert("Something went wrong");
            }
        }
    });
});

document.getElementById('post-button').addEventListener('click', async () => {
    await fetch('./controllers/post.php', {
        method: 'POST',
        data: "post-content=" + document.getElementById('post-content').value,
        success: (result) => {
            if(result === "1") {
                document.getElementById('post-success').style.display = "block";
                document.getElementById('post-fail').style.display = "none";
            } else if(result !== "") {
                document.getElementById('post-fail').style.display = "block";
                document.getElementById('post-success').style.display = "none";
            }
        }
    });
});