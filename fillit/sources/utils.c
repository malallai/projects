/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 14:03:14 by malallai          #+#    #+#             */
/*   Updated: 2019/01/08 10:50:06 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

void	print_error()
{
	ft_putendl("error");
}

int		print_int_error()
{
	ft_putendl("error");
	return (0);
}

int		is_valid_char(char c)
{
	return (c == '.' || c == '#' || c == '\n');
}