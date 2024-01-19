package com.example.car.models;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class Car {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    
    Long id;
    String marca;
    Integer speed_max;
    String targa;

    public Car(){}

    public Car(String marca, Integer speed_max, String targa){
        this.marca=marca;
        this.speed_max=speed_max;
        this.targa=targa;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getMarca() {
        return marca;
    }

    public void setMarca(String marca) {
        this.marca = marca;
    }

    public Integer getSpeed_max() {
        return speed_max;
    }

    public void setSpeed_max(Integer speed_max) {
        this.speed_max = speed_max;
    }

    public String getTarga() {
        return targa;
    }

    public void setTarga(String targa) {
        this.targa = targa;
    }
}

