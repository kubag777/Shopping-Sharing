import React from 'react';
import '../css/global.css';
import '../css/profile.css';

const ProfilePage: React.FC = () => {
    const getName = () => {
        // TODO
        return "Jakub";
    };

    const getSurname = () => {
        // TODO
        return "Test";
    };

    const getUserId = () => {
        const Id = sessionStorage.getItem('userId');
        if (Id) {
            return Id;
        }
        return "";
    };

    const userName = getName();
    const userSurname = getSurname();
    const userId = getUserId();

    return (
        <div>
            <div className="profileMainFrame">
                <div className="picture"><img src="../../public/profile-picture.jpg" alt="Profile" className="profileimg"/></div>
                <div className="info">
                    <h1>{`${userName} ${userSurname}`}</h1>
                    <h1>Twoje UUID:</h1><h3> {userId.toString()}</h3>
                </div>
            </div>
        </div>
    );
};

export default ProfilePage;
