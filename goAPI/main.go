package main

import (
	"encoding/json"
	"fmt"
	"io/ioutil"
	"log"
	"net/http"

	"github.com/gorilla/mux"
)

type nota struct {
	ID          string `json:"ID"`
	Title       string `json:"Title"`
	Description string `json:"Description"`
	Status      string `json:"Status"`
}

type allNotas []nota

var notas = allNotas{
	{
		ID:          "1",
		Title:       "Distibuidos",
		Description: "Hacer practico de distribuidos",
		Status:      "En curso",
	},
}

func homeLink(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, "Bienvenido a API para crear tus Notas!")
}

func createNota(w http.ResponseWriter, r *http.Request) {
	var newNota nota
	reqBody, err := ioutil.ReadAll(r.Body)
	if err != nil {
		fmt.Fprintf(w,"Ingrese titulo, descripcion y estado de nota para crear nota")
	}
	
	json.Unmarshal(reqBody, &newNota)
	notas = append(notas, newNota)
	w.WriteHeader(http.StatusCreated)

	json.NewEncoder(w).Encode(newNota)
}

func getOneNota(w http.ResponseWriter, r *http.Request) {
	notaID := mux.Vars(r)["id"]

	for _, singleNota := range notas {
		if singleNota.ID == notaID {
			json.NewEncoder(w).Encode(singleNota)
		}
	}
}

func getAllNotas(w http.ResponseWriter, r *http.Request) {
	json.NewEncoder(w).Encode(notas)
}

func updateNota(w http.ResponseWriter, r *http.Request) {
	notaID := mux.Vars(r)["id"]
	var updatedNota nota

	reqBody, err := ioutil.ReadAll(r.Body)
	if err != nil {
		fmt.Fprintf(w, "Ingrese titulo, descripcion y estado de nota para actualizar nota")
	}
	json.Unmarshal(reqBody, &updatedNota)

	for i, singleNota := range notas {
		if singleNota.ID == notaID {
			singleNota.Title = updatedNota.Title
			singleNota.Description = updatedNota.Description
			notas = append(notas[:i], singleNota)
			json.NewEncoder(w).Encode(singleNota)
		}
	}
}

func deleteNota(w http.ResponseWriter, r *http.Request) {
	notaID := mux.Vars(r)["id"]

	for i, singleNota := range notas {
		if singleNota.ID == notaID {
			notas = append(notas[:i], notas[i+1:]...)
			fmt.Fprintf(w, "La nota con ID %v se borró satisfactoriamente", notaID)
		}
	}
}

func main() {
	router := mux.NewRouter().StrictSlash(true)
	router.HandleFunc("/", homeLink)
	router.HandleFunc("/nota", createNota).Methods("POST")
	router.HandleFunc("/notas", getAllNotas).Methods("GET")
	router.HandleFunc("/notas/{id}", getOneNota).Methods("GET")
	router.HandleFunc("/notas/{id}", updateNota).Methods("PATCH")
	router.HandleFunc("/notas/{id}", deleteNota).Methods("DELETE")
	log.Fatal(http.ListenAndServe(":8080", router))
}