<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<style>
/* Main Styles */


/* Chat Page */
.chat-page {
    background-color: #ffffff;
}

/* Chat Wrapper */
.main-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Chat Left (Contacts List) */
.chat-cont-left {
    background-color: #f1f1f1;
    border-right: 1px solid #ddd;
    padding: 15px;
}

.chat-header {
    font-size: 1.2rem;
    color: #128C7E;
    padding-bottom: 10px;
}

.chat-users-list {
    max-height: 400px;
    overflow-y: auto;
}

.chat-scroll {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.media {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 10px 0;
    transition: background-color 0.3s;
}

.media:hover {
    background-color: #e9f5f5;
}

.media-img-wrap {
    margin-right: 10px;
}

.avatar-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.user-name {
    font-weight: bold;
}

.user-last-chat {
    font-size: 0.9rem;
    color: #555;
}

/* Chat Right (Chat Window) */
.chat-cont-right {
    padding: 15px;
}

.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 15px;
    border-bottom: 1px solid #ddd;
}

.chat-body {
    max-height: 400px;
    overflow-y: auto;
    padding: 10px 0;
}

.media.sent .msg-box {
    color: #128C7E;
}

.media.received .msg-box {
    background-color: #000000;
}

.chat-time {
    font-size: 0.8rem;
    color: #aaa;
}

.chat-footer {
    margin-top: 15px;
}

.input-msg-send {
    border-radius: 20px;
    padding: 10px;
    border: 1px solid #ccc;
}

.msg-send-btn {
    background-color: #128C7E;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 20px;
    cursor: pointer;
}

.msg-send-btn:hover {
    background-color: #0d7367;
}

/* Media Queries */
@media (max-width: 768px) {
    .chat-cont-left {
        display: none;
    }

    .chat-cont-right {
        padding: 10px;
    }
}

@media (max-width: 576px) {
    .media {
        flex-direction: column;
        align-items: flex-start;
    }

    .chat-header {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<body class="chat-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="settings-back mb-3">
                    <a href="{{route('mentee.dashboard')}}">
                        <i class="fas fa-long-arrow-alt-left"></i> <span>Dashboard</span>
                    </a>
                </div>
                <div class="row">
                    <!-- Left Chat List -->
                    <div class="col-lg-4 col-md-5 col-12 mb-4">
                        <div class="chat-cont-left">
                            <div class="chat-header">
                                <h4>Chats</h4>
                            </div>
                            <div class="chat-users-list">
                                <div class="chat-scroll">
                                    @foreach ($mentorships as $mentorship)
                                    <a href="javascript:void(0);" class="media d-flex"
                                        onclick="startChat({{ $mentorship->mentor->id }})"
                                        style="text-decoration: none;">
                                        <div class="media-img-wrap flex-shrink-0">
                                            <div class="avatar">
                                                <img src="{{ asset('storage/'.$mentorship->mentor->image) }}"
                                                    alt="Mentor Image" class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="media-body flex-grow-1">
                                            <div class="user-name">{{ $mentorship->mentor->name }}</div>
                                            <div class="user-last-chat">Hey, How are you?</div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Chat Window -->
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="chat-cont-right">
                            <div class="chat-header">
                                <div class="media d-flex">
                                    <div class="media-img-wrap flex-shrink-0">
                                        <div class="avatar">
                                            <img src="{{ asset('storage/'.$mentor->image) }}" alt="Mentor Image"
                                                class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="media-body flex-grow-1">
                                        <div class="user-name">{{ $mentor->name }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="chat-body" id="chat-body">
                                @foreach($messages as $message)
                                <div class="media {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}">
                                    <div class="media-body">
                                        <div class="msg-box">
                                            <p>{{ $message->message }}</p>
                                            <ul class="chat-msg-info">
                                                <li>
                                                    <div class="chat-time">
                                                        <span>{{ $message->created_at->format('h:i A') }}</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="chat-footer">
                                <form id="chat-form" class="message-form">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="input-msg-send form-control" id="messageInput"
                                            placeholder="Type something" required>
                                        <button type="submit" class="btn msg-send-btn">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form reload

        const messageInput = document.getElementById('messageInput');
        const chatBody = document.getElementById('chat-body');

        if (!messageInput.value.trim()) {
            alert('Message cannot be empty');
            return;
        }

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('message', messageInput.value);

        // Disable input during sending
        messageInput.disabled = true;

        fetch("{{ route('mentee.messages.send', ['mentor_id' => $mentor->id]) }}", {
                method: 'POST',
                body: formData,
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Add new message to the chat body
                    const newMessage = document.createElement('div');
                    newMessage.classList.add('media', 'sent');
                    newMessage.innerHTML = `
                        <div class="media-body flex-grow-1">
                            <div class="msg-box">
                                <p>${data.message}</p>
                                <ul class="chat-msg-info">
                                    <li>
                                        <div class="chat-time"><span>${new Date().toLocaleTimeString()}</span></div>
                                    </li>
                                </ul>
                            </div>
                        </div>`;
                    chatBody.appendChild(newMessage);

                    // Scroll to the bottom
                    chatBody.scrollTop = chatBody.scrollHeight;

                    // Clear the input field
                    messageInput.value = '';
                } else {
                    alert('Error sending message');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            })
            .finally(() => {
                // Re-enable input
                messageInput.disabled = false;
            });
    });
    </script>

</body>

</html>