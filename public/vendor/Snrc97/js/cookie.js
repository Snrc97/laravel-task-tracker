

class CookieManager {
    constructor(key, value) {
        this.key = key;
        this.value = value;
    }

    addCookie(key, value)
    {
        if(!getCookie(key)) {
            document.cookie = key + '=' + value + ';path=/' + ';expires=Fri, 31 Dec 9999 23:59:59 GMT';
        }

        return this;
    }

    addCookies(cookies) {
        for (let i = 0; i < cookies.length; i++) {
            this.addCookie(cookies[i].key, cookies[i].value);
        }
    }

     getCookie(key)
    {
        const cookies = document.cookie.split('; ');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].split('=');
            if (cookie[0] === key) {
                return cookie[1];
            }
        }
        return null;
    }

     clearCookies() {
        document.cookie = "access_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }

    toString() {
        return this.key + '=' + this.value;
    }
}

const cookieManager = new CookieManager();

