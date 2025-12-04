<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up" style="max-width:720px; margin:0 auto;">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Salon assistant chatbot
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Prototype chat interface for FR‑18. In a full system this would connect to an AI
                API; here it answers with simple canned responses about booking, branches, and
                opening hours.[file:1]
            </p>

            <div class="card" style="height:420px; display:flex; flex-direction:column;">
                <div id="chatLog"
                     style="flex:1 1 0; overflow-y:auto; margin-bottom:0.7rem; font-size:0.85rem;">
                    <div style="margin-bottom:0.5rem;">
                        <div style="color:#4ade80; font-weight:600; margin-bottom:0.1rem;">Bot</div>
                        <div style="color:#e5e7eb;">
                            Hi! Ask me about services, branches, or how to book an appointment.
                        </div>
                    </div>
                </div>

                <form id="chatForm" onsubmit="handleChatSubmit(event)"
                      style="display:flex; gap:0.6rem; align-items:center;">
                    <input type="text"
                           id="chatInput"
                           autocomplete="off"
                           placeholder="Type your question..."
                           style="flex:1 1 0; background:#020617; border-radius:999px; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.45rem 0.9rem; font-size:0.85rem;">
                    <button type="submit"
                            class="btn btn-pink glow-btn"
                            style="padding-inline:1.2rem; font-size:0.85rem;">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        function appendMessage(sender, text) {
            const log = document.getElementById('chatLog');
            const wrapper = document.createElement('div');
            wrapper.style.marginBottom = '0.5rem';

            const name = document.createElement('div');
            name.style.marginBottom = '0.1rem';
            name.style.fontWeight = '600';
            name.style.fontSize = '0.8rem';
            if (sender === 'You') {
                name.style.color = '#60a5fa';
            } else {
                name.style.color = '#4ade80';
            }
            name.textContent = sender;

            const body = document.createElement('div');
            body.style.color = '#e5e7eb';
            body.textContent = text;

            wrapper.appendChild(name);
            wrapper.appendChild(body);
            log.appendChild(wrapper);
            log.scrollTop = log.scrollHeight;
        }

        function getBotReply(message) {
            const m = message.toLowerCase();

            if (m.includes('book') || m.includes('appointment')) {
                return 'You can book online from the “Book” menu or by visiting /booking, then choosing service, branch, date and time.';
            }
            if (m.includes('branch') || m.includes('location')) {
                return 'The system supports multiple branches such as Banani, Dhanmondi and Gulshan. You can see details on the home page under “Our branches”.';
            }
            if (m.includes('time') || m.includes('open')) {
                return 'Typical opening hours are 10:00 AM – 8:00 PM, but admins can adjust staff schedules in the Staff section.';
            }
            if (m.includes('price') || m.includes('cost')) {
                return 'Service prices are listed on the Services page. Each service card shows BDT price and duration.';
            }

            return 'This demo bot can answer questions about booking, branches, hours, and prices. For other questions, please contact the salon directly.';
        }

        function handleChatSubmit(e) {
            e.preventDefault();
            const input = document.getElementById('chatInput');
            const text = input.value.trim();
            if (!text) return;

            appendMessage('You', text);
            input.value = '';

            const reply = getBotReply(text);
            setTimeout(() => appendMessage('Bot', reply), 300);
        }
    </script>
</x-app-layout>
