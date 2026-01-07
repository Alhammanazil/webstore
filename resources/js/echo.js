import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

// Normalize host/scheme so local http does not try wss and avoids localhost/hostname mismatch.
const reverbScheme =
    import.meta.env.VITE_REVERB_SCHEME ??
    (window.location.protocol === "https:" ? "https" : "http");
const reverbHost = import.meta.env.VITE_REVERB_HOST ?? window.location.hostname;
const reverbPort =
    import.meta.env.VITE_REVERB_PORT ?? (reverbScheme === "https" ? 443 : 80);

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: reverbHost,
    wssHost: reverbHost,
    wsPort: reverbPort,
    wssPort: reverbPort,
    forceTLS: reverbScheme === "https",
    enabledTransports: reverbScheme === "https" ? ["wss"] : ["ws"],
});
