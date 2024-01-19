package com.example.car.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import org.springframework.ui.Model;
import com.example.car.models.Car;
import com.example.car.repositories.CarRepository;

@Controller
public class CarController {

    private final CarRepository repo;

    public CarController(CarRepository repo) {
        this.repo = repo;
    }

    @GetMapping("/")
    public String index(Model model) {
        model.addAttribute("Cars", repo.findAll());
        return "index"; 
    }  
    
    @GetMapping("/create")
    public String create() {
        return "create"; 
    }  

    @PostMapping("/store")
    public String store(Car car) {
        repo.save(car);
        return "redirect:/"; 
    }  

    @GetMapping("/show")
    public String show(Long id, Model model) {
        Car car = repo.findById(id).orElse(null);
        model.addAttribute("car", car);
        return "show";
    }

    @GetMapping("/edit")
    public String edit(Model model, Long id) {
        Car car = repo.findById(id).orElse(null);
        model.addAttribute("car", car);
        return "edit";
    }

    @PostMapping("/update")
    public String update(Car car) {
        repo.save(car);
        return "redirect:/";
    }

    @PostMapping("/delete")
    public String delete(Long id) {
        repo.deleteById(id);
        return "redirect:/";
    }
}