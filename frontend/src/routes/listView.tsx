import React, { useEffect, useState } from 'react';
import { useParams } from "react-router-dom";
import '../css/listView.css';

const ListView = () => {

    const { id } = useParams(); // odczytanie ID

    // const deleteList = () => {
    //     // Przeniesienie na stronę list
    //     window.location.href = '/lists';
    //     const data = new FormData();
    //     if (id) {
    //         data.append('list_id', id);
    //         postData("/deleteList", data);
    //     }
    // };

    // const postData = (url: string, data: FormData) => {
    //     const options: RequestInit = {
    //         method: 'POST',
    //         body: data,
    //     };

    //     fetch(url, options)
    //         .then(response => {
    //             console.log(response.status);
    //             //window.location.reload();
    //             return response.text();
    //         })
    //         .catch(error => console.error('Error:', error));
    // };

    const addNewField = (e: React.FormEvent) => {
        e.preventDefault();
        const data = new FormData(e.target as HTMLFormElement);
        if (id) {
            data.append('list_id', id);
            //postData("/addNewField", data);
        }
    };

    const addNewFieldWnd = () => {
        const newFieldWnd = document.querySelector('.newFieldWnd');
        if (newFieldWnd) {
            newFieldWnd.classList.toggle('visible');
        }
    };

    useEffect(() => {
        if (id) {
            const data = new FormData();
            data.append('field_id', id);
            //postData("/changeFieldState", data);
        }
    }, [id]);
    console.log(id);
    return (
        <div>
            <div className="mainFrame">
                <div className="header">
                    <button className="deleteList" type="button" /*onClick={deleteList}*/>Usuń listę</button>
                    <span>Nazwa listy ID: {id}</span>
                    <button className="addFieldButton" type="button" onClick={addNewFieldWnd}><div className="addNew">+</div></button>
                </div>
                <div className="fields">
                </div>
            </div>
            <div className="newFieldWnd">
                <form onSubmit={addNewField} className="addNewField">
                    <input type="fieldName" name="fieldName" placeholder="Nazwa pola" />
                    <input type="submit" value="Dodaj" />
                </form>
            </div>
        </div>
    );
};

export default ListView;
