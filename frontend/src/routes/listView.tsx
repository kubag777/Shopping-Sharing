import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import '../css/listView.css';
import axios from 'axios';
import { Checkbox } from '@mui/material';
import { CheckCircle as CheckCircleIcon, RadioButtonUnchecked as RadioButtonUncheckedIcon } from '@mui/icons-material';


interface User {
    id: string;
    name: string;
}

interface ListField {
    id: string;
    name: string;
    checked: boolean;
}

interface MyList {
    ID: string;
    Name: string;
    CreateDate: string;
    OwnerUserId: User;
    UserIds: User[];
    listFields: ListField[];
}

const ListView = () => {
    const { id } = useParams<{ id: string }>(); // odczytanie ID
    const [list, setList] = useState<MyList | null>(null);
    const [updateNeeded, setUpdateNeeded] = useState(true);

    const handleCheckboxChange = async (index: number) => {          
        if (list) {
            list.listFields[index].checked = !list.listFields[index].checked;
            const fieldId = list.listFields[index].id;
            try {
                const response = await axios.patch(`https://localhost/api/list_fields/${fieldId}`, 
                    {
                        checked: list.listFields[index].checked//updatedCheckedState[index]
                    },
                    {
                        headers: {
                            'Content-Type': 'application/merge-patch+json'
                        }
                    }
                );
                if (response.status === 200) {
                    console.log('Checkbox state updated successfully.');
                    setUpdateNeeded(true);
                } else {
                    console.error('Error updating checkbox state.');
                }
            } catch (error) {
                console.error('Network error:', error);
            }
        }
    };

    const fetchListById = async (listId: string) => {
        try {
            console.log(`Fetching list with ID: ${listId}`);
            const response = await axios.get(`https://localhost/api/my/list/${listId}`);
            if (response.status !== 200) {
                throw new Error('Network response was not ok');
            }
            const data = response.data;
            // Pobranie pełnych informacji o polach na podstawie URI
            const fieldsDataPromises = data.listFields.map(async (fieldURI: string) => {
                const fieldResponse = await axios.get(`https://localhost${fieldURI}`);
                return fieldResponse.data;
            });
            const fieldsData = await Promise.all(fieldsDataPromises);
            // Zastąpienie identyfikatorów URI pełnymi danymi pól
            const updatedListData = { ...data, listFields: fieldsData };
            setList(updatedListData);  // aktualizacja stanu komponentu z otrzymanymi danymi listy
        } catch (error) {
            console.error('Error:', error);
        }
    };

    useEffect(() => {
        if (id && updateNeeded){
            fetchListById(id);
            setUpdateNeeded(false);
        }
    }, [updateNeeded]);

    const addNewField = async (e: React.FormEvent) => {
        e.preventDefault();
        const data = new FormData(e.target as HTMLFormElement);
        const userId = sessionStorage.getItem('userId');
        if (id) {
            try {
                const listIdIri = `api/my/list/${id}`;
                const userIri = `/api/users/${userId}`;
                const response = await axios.post('https://localhost/api/list_fields',
                    {
                        ListID: listIdIri,
                        name: data.get('fieldName') as string,
                        CreateUser: userIri,
                        checked: false
                    },
                    {
                        headers: {
                            'Content-Type': 'application/ld+json'
                        }
                    }
                );
                if (response.status === 201) {
                    console.log('Field added successfully, refreshing list...');
                    setUpdateNeeded(true);
                } else {
                    console.error('Błąd dodawania listy.');
                }

            } catch (error) {
                console.error('Błąd sieci:', error);
            }
        }
    };

    const addNewFieldWnd = () => {
        const newFieldWnd = document.querySelector('.newFieldWnd');
        if (newFieldWnd) {
            newFieldWnd.classList.toggle('visible');
        }
    };

    return (
        <div>
            <div className="mainFrame">
                <div className="header">
                    <button className="deleteList" type="button" /*onClick={deleteList}*/>
                        Usuń listę
                    </button>
                    <span>{list?.Name}</span>
                    <button className="addFieldButton" type="button" onClick={addNewFieldWnd}>
                        <div className="addNew">+</div>
                    </button>
                </div>
                <div className="fields">
                    {list?.listFields ? (
                        list.listFields.map((field, index) => (
                            <div key={field.id} className="oneField">
                                <a>{field.name}</a>
                                <Checkbox
                                    className="customCheckbox"
                                    icon={<RadioButtonUncheckedIcon />}
                                    checkedIcon={<CheckCircleIcon />}
                                    checked={list.listFields[index].checked}
                                    onChange={() => handleCheckboxChange(index)}
                                    // dodać wysyłanie do bazy zmiany checkboxa
                                />
                            </div>

                        ))
                    ) : (
                        <p className="black">Ładowanie... </p>
                    )}
                </div>
            </div>
            <div className="newFieldWnd">
                <form onSubmit={addNewField} className="addNewField">
                    <input type="text" name="fieldName" placeholder="Nazwa pola" />
                    <input type="submit" value="Dodaj" />
                </form>
            </div>
        </div>
    );
};

export default ListView;
