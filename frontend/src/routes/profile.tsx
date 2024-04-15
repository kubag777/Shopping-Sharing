import React from 'react';
import '../css/global.css';
import '../css/profile.css';

const ProfilePage: React.FC = () => {
    // Simulating the PHP code logic for fetching user data
    const getName = () => {
        // Replace with actual logic to get user name
        return "Jakub";
    };

    const getSurname = () => {
        // Replace with actual logic to get user surname
        return "Test";
    };

    const getUserId = () => {
        // Replace with actual logic to get user ID
        return "910f6809-4178-47cf-802b-b259b1b270ba";
    };

    const userName = getName();
    const userSurname = getSurname();
    const userId = getUserId();

    return (
        <div>
            <div className="profileMainFrame">
                <div className="picture"><img src="/public/img/profile.jpg" alt="Profile" /></div>
                <div className="info">
                    <h1>{`${userName} ${userSurname}`}</h1>
                    <h1>Twoje UUID:</h1><h3> {userId}</h3>
                    <h3>Jakiś opis</h3>
                </div>
            </div>
        </div>
    );
};

export default ProfilePage;
