package com.example.owner_dog.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import com.example.owner_dog.models.Dog;
import com.example.owner_dog.repositories.DogRepository;
import com.example.owner_dog.repositories.OwnerRepository;

@Controller
public class DogController {
    
    final DogRepository repo;
    final OwnerRepository ownerRepo;

    public DogController(DogRepository repo, OwnerRepository ownerRepo) {
        this.repo = repo;
        this.ownerRepo = ownerRepo;
    }

    @GetMapping("/dogs")
    String index(Model model) {
        model.addAttribute("dogs", repo.findAll());
        return "/dogs/index";
    }

    @GetMapping("/dogs/create")
    String create(Model model) {
        model.addAttribute("owners", ownerRepo.findAll());
        return "/dogs/create";
    }

    @PostMapping("/dogs/store")
    String store(Dog d) {
        repo.save(d);
        return "redirect:/dogs";
    }

    @GetMapping("/dogs/show")
    String show(Model model, Long id) {
        model.addAttribute("d", repo.findById(id).orElse(null));
        return "/dogs/show";
    }

    @GetMapping("/dogs/edit")
    String edit(Model model, Long id) {
        model.addAttribute("owners", ownerRepo.findAll());
        model.addAttribute("d", repo.findById(id).orElse(null));
        return "/dogs/edit";
    }

    @PostMapping("/dogs/update")
    String update(Dog d) {
        repo.save(d);
        return "redirect:/dogs";
    }

    @PostMapping("/dogs/destroy")
    String destroy(Long id) {
        repo.deleteById(id);
        return "redirect:/dogs";
    }
}
