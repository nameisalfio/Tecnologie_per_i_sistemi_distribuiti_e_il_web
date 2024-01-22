package com.example.client_order.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import com.example.client_order.models.Client;
import com.example.client_order.repositories.ClientRepository;

@Controller
public class ClientController {
    
    final ClientRepository repo;

    public ClientController(ClientRepository repo) {
        this.repo = repo;
    }

    @GetMapping("/")
    String welcome(){
        return "welcome";
    }

    @GetMapping("/clients")
    String index(Model model){
        model.addAttribute("clients", repo.findAll());
        return "/clients/index";
    }

    @GetMapping("/clients/create")
    String create(){
       return "/clients/create";
    }

    @PostMapping("/clients/store")
    String store(Client c){
        repo.save(c);
        return "redirect:/clients";
    }

    @GetMapping("/clients/show")
    String show(Long id, Model model){
        model.addAttribute("c", repo.findById(id).orElse(null));
        return "/clients/show";
    }

    @GetMapping("/clients/edit")
    String edit(Long id, Model model){
        model.addAttribute("c", repo.findById(id).orElse(null));
        return "/clients/edit";
    }

    @PostMapping("/clients/update")
    String update(Client c){
        repo.save(c);
        return "redirect:/clients";
    }

    @PostMapping("/clients/destroy")
    String destroy(Long id){
        repo.deleteById(id);
        return "redirect:/clients";
    }
}
