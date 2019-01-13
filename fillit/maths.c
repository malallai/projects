/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   maths.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/13 17:03:07 by malallai          #+#    #+#             */
/*   Updated: 2019/01/13 17:05:07 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		ft_sqrt(int n)
{
	int size;

	size = 2;
	while (size * size < n)
		size++;
	return (size);
}

int		is_valid_char(char c)
{
	return (c == '.' || c == '#' || c == '\n');
}
