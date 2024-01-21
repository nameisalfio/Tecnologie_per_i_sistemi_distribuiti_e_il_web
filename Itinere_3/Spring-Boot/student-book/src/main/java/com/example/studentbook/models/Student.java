package com.example.studentbook.models;

import jakarta.persistence.*;

@Entity
@Table(name="students")
public class Student {
    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)

    Long id;
    String name;
    String lastname;
    Integer age;
    
    public Student() {
    }

    public Student(String name, String lastname, Integer age) {
        this.name = name;
        this.lastname = lastname;
        this.age = age;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getLastname() {
        return lastname;
    }

    public void setLastname(String lastname) {
        this.lastname = lastname;
    }

    public Integer getAge() {
        return age;
    }

    public void setAge(Integer age) {
        this.age = age;
    }
}
